<?php
/**
 * Cloudways Git Deployment Script
 *
 * This script handles the deployment of the Random Bit Logic theme
 * when using Cloudways Git Deployment feature.
 *
 * @package RandomBitLogic
 * @version 1.0.0
 */

// Configuration
define('DEPLOYMENT_LOG', __DIR__ . '/deployment.log');
define('THEME_SOURCE', __DIR__ . '/wp-content/themes/random-bit-logic');
define('THEME_DEST', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/random-bit-logic');

/**
 * Log deployment messages
 */
function log_message($message) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] {$message}\n";
    file_put_contents(DEPLOYMENT_LOG, $log_entry, FILE_APPEND);
    echo $log_entry;
}

/**
 * Copy directory recursively
 */
function copy_directory($src, $dst) {
    if (!is_dir($src)) {
        log_message("Error: Source directory does not exist: {$src}");
        return false;
    }

    // Create destination directory if it doesn't exist
    if (!is_dir($dst)) {
        if (!mkdir($dst, 0755, true)) {
            log_message("Error: Failed to create destination directory: {$dst}");
            return false;
        }
        log_message("Created directory: {$dst}");
    }

    $dir = opendir($src);
    if (!$dir) {
        log_message("Error: Failed to open source directory: {$src}");
        return false;
    }

    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            $src_path = $src . '/' . $file;
            $dst_path = $dst . '/' . $file;

            if (is_dir($src_path)) {
                copy_directory($src_path, $dst_path);
            } else {
                if (copy($src_path, $dst_path)) {
                    log_message("Copied: {$file}");
                } else {
                    log_message("Error: Failed to copy: {$file}");
                }
            }
        }
    }

    closedir($dir);
    return true;
}

/**
 * Main deployment process
 */
function deploy() {
    log_message("=== Starting Random Bit Logic Theme Deployment ===");
    log_message("Source: " . THEME_SOURCE);
    log_message("Destination: " . THEME_DEST);

    // Check if source exists
    if (!is_dir(THEME_SOURCE)) {
        log_message("Error: Theme source directory not found!");
        return false;
    }

    // Backup existing theme if it exists
    if (is_dir(THEME_DEST)) {
        $backup_dir = THEME_DEST . '_backup_' . date('YmdHis');
        log_message("Backing up existing theme to: {$backup_dir}");

        if (rename(THEME_DEST, $backup_dir)) {
            log_message("Backup created successfully");
        } else {
            log_message("Warning: Failed to create backup");
        }
    }

    // Copy theme files
    log_message("Copying theme files...");
    if (copy_directory(THEME_SOURCE, THEME_DEST)) {
        log_message("Theme files copied successfully");
    } else {
        log_message("Error: Failed to copy theme files");
        return false;
    }

    // Set proper permissions
    log_message("Setting file permissions...");
    chmod(THEME_DEST, 0755);

    log_message("=== Deployment Completed Successfully ===");
    return true;
}

// Execute deployment
try {
    $result = deploy();
    exit($result ? 0 : 1);
} catch (Exception $e) {
    log_message("Fatal Error: " . $e->getMessage());
    exit(1);
}

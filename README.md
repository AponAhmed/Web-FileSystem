# Web File System

## Overview

The Web File System is a PHP-based web application that provides a simple and intuitive file management interface. It allows users to navigate through directories, view files, and perform basic file operations. The application includes a file icon system to visually represent different file types and supports encryption for URL parameters to enhance security.

## Sceeenshot
![File system for Web](https://github.com/AponAhmed/Web-FileSystem/blob/main/ss.png?raw=true)


## Features

- **Directory Navigation**: Easily navigate through directories and view folder contents.
- **File Viewing**: Display file icons and names for quick identification.
- **URL Encryption**: Securely encrypt URL parameters for enhanced privacy.
- **File Icons**: Visual representation of different file types using custom icons.
- **Breadcrumb Navigation**: Display a breadcrumb trail for easy navigation.

## Usage

1. **Installation**: Download the Web File System files and deploy them to your web server.

2. **Configuration**: Adjust configuration options such as the root directory, URL encryption, and other settings.

3. **File Navigation**: Use the intuitive interface to navigate through directories and view files.

4. **URL Encryption**: Enable or disable URL encryption based on your security requirements.

5. **File Icons**: Customize file icons by adding new icons to the designated directory.

## Folder Data Structure

The application organizes folder data in a hierarchical structure, allowing for easy traversal. The folder data includes details such as file paths, names, parent directories, and child items.

## Classes

### `FileIcon`

- **`get($fileType)`**: Generate HTML for displaying a folder icon based on the file type.
- **`fileTypeIcon($extension)`**: Generate HTML for displaying a file icon based on the file extension.

### `FileSystem`

- **`__construct($options)`**: Initialize the file system with provided options.
- **`getFileData()`**: Retrieve and return folder data for the current directory.
- **`controller()`**: Invoke the file system controller to handle the application's logic.
- **`nav()`**: Display breadcrumb navigation for the current directory.
- **`getFileExp()`**: Display file icons and names for the current directory.

### `FileSystemController`

- **`__construct($fs)`**: Initialize the controller with the file system instance.
- **`currentDirNav()`**: Display breadcrumb navigation for the current directory.
- **`controllerHtm()`**: Display HTML for file system controls.

## Installation

1. Download the Web File System files.
2. Deploy the files to your web server.
3. Configure the application options in the relevant files.

## Configuration

Adjust the configuration options in the `FileSystem` class constructor to set the root directory, URL encryption, and other parameters.

## Credits

This Web File System is developed by [Aponahmed](https://github.com/Aponahmed). Feel free to contribute to the development on [GitHub](https://github.com/Aponahmed/Web-FileSystem).

**Version:** 1.0


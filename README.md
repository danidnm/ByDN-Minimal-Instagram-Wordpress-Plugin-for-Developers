# ByDN Minimal Instagram Wordpress Plugin for Developers

**Version:** 1.0.0  
**Author:** [Daniel Navarro](https://danielnavarroymas.com)  
**License:** GPLv2 or later  
**Text Domain:** bydn-instagram  

## Description

**ByDN Instagram** is a WordPress plugin aimed at developers that allows basic integration of Instagram posts into a website, serving as a foundation to adapt it to the needs of each project.

The configuration only requires your Instagram ID and access token.

A cron task will retrieve Instagram posts (caption and URL) to the WordPress database, and using a provided shortcode, images filtered by #hashtag can be inserted into the desired pages or posts.

The provided layout is basic and is expected to be adapted by the developer to the project.

### Features

- **Simple Configuration:** A configuration page in the admin panel to add your Instagram account and token.
- **Automatic Synchronization:** A scheduled task that synchronizes posts automatically every hour.
- **Customizable Shortcode:** A shortcode `[instagram_posts]` that can be used to display filtered posts.
- **Modular Design:** The code is divided into modules for easy extension and customization.

### Requirements

- WordPress 5.0+
- PHP 5.7+

## Installation

### Manual

1. Download the plugin `.zip` file.
2. Extract the content and upload the `bydn-instagram` folder to the `wp-content/plugins/` directory.
3. Activate the plugin from the WordPress admin panel.

## Usage

### Configuration

1. Go to "ByDN Instagram" in the admin menu.
2. Enter your **Instagram Account** and **Instagram Token**.
3. Click on "Save Changes".

### Shortcode

- **Show All Posts:**
  ```html
  [instagram_posts]

- **Show posts with the hashtag #summer:**
  ```html
  [instagram_posts caption="summer"]

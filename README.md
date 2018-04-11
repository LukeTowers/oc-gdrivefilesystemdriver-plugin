# About

October-fied implementation of the [Google Drive Flysystem Driver](https://github.com/nao-pon/flysystem-google-drive). 

# Important Note:

Google Drive is an ID-based filesystem; it supports having multiple files with the same name within a given directory. This driver exposes the file and directory IDs when requesting filenames which means if you hooked it up the the Media manager to view your files you would see something like the picture below:

![Google Drive IDs instead of filenames](https://user-images.githubusercontent.com/7253840/38589679-b2e45652-3ce9-11e8-94cf-e0f1f3d4890a.png)

# Installation

To install from the [Marketplace](https://octobercms.com/plugin/luketowers-gdrivefilesystemdriver), click on the "Add to Project" button and then select the project you wish to add it to before updating the project to pull in the plugin.

To install from the backend, go to **Settings -> Updates & Plugins -> Install Plugins** and then search for `LukeTowers.GDriveFileSystemDriver`.

To install from [the repository](https://github.com/luketowers/oc-gdrivefilesystemdriver-plugin), clone it into **plugins/luketowers/gdrivefilesystemdriver** and then run `composer update` from your project root in order to pull in the dependencies.

To install it with Composer, run `composer require luketowers/oc-gdrivefilesystemdriver-plugin` from your project root.

# Configuration

Example Storage disk configuration using the `googledrive` storage driver provided by this plugin:

    'mygoogledrive' => [
        'driver' => 'googledrive',
        'clientId' => '',
        'clientSecret' => '',
        'refreshToken' => '',
        
        // Null for the route folder, otherwise a folder ID to base the driver off of
        'folderId' => null,
    ],

See the Configuration Guides at the bottom for how to get the values for `clientId`, `clientSecret`, `refreshToken`, & `folderId`.

# Usage

For usage examples of interacting with this driver see the usage examples here: [ivanvermeyen/laravel-google-drive-demo#available-routes](https://github.com/ivanvermeyen/laravel-google-drive-demo#available-routes)

# Configuration Guides

## Getting your Client ID and Secret

Log in to your Google Account and go to this website:

https://console.developers.google.com/

### Create a Project

Create a new project using the dropdown at the top.

<img width="463" alt="Create a new project" src="https://cloud.githubusercontent.com/assets/3598622/22397261/060eac9e-e56e-11e6-907c-717932605569.png">

After you enter a name, it takes a few seconds before the project is successfully created on the server.

### Enable Drive API

Make sure you have the project selected at the top.

Then go to Library and click on "Drive API" under "G Suite APIs".

<img width="1168" alt="Add Drive API" src="https://user-images.githubusercontent.com/3598622/28462245-a13b3d9c-6e1a-11e7-8cf8-0082ac8a9141.png">

And then Enable it.

<img width="383" alt="Enable Google Drive API" src="https://cloud.githubusercontent.com/assets/3598622/22397290/a858c6d8-e56e-11e6-9154-0052d7ecd0eb.png">

### Create Credentials

Go to "Credentials" and click on the tab "OAuth Consent Screen". Fill in a "Product name shown to users" and Save it. Don't worry about the other fields.

<img width="896" alt="Consent Screen" src="https://cloud.githubusercontent.com/assets/3598622/22397326/549fb3c0-e56f-11e6-9b0a-8771b0ba72b4.png">

Then go back to Credentials, click the button that says "Create Credentials" and select "OAuth Client ID".

<img width="435" alt="Create Credentials" src="https://cloud.githubusercontent.com/assets/3598622/22397368/33f8bd0a-e570-11e6-859c-34d112c772e4.png">

Choose "Web Application" and give it a name.

Add https://developers.google.com/oauthplayground in "Authorized redirect URIs". You will need to use this in the next step to get your refresh token. Once you have the token, you can remove the URI.

<img width="910" alt="Credentials" src="https://user-images.githubusercontent.com/3598622/28473452-e675826c-6e44-11e7-8ff0-bea423b0cff7.png">

Click Create and take note of your **Client ID** and **Client Secret**.

## Getting your Refresh Token

Go to https://developers.google.com/oauthplayground.

> Make sure you added this URL to your Authorized redirect URIs in the [previous step](1-getting-your-dlient-id-and-secret.md).

In the top right corner, click the settings icon, check "Use your own OAuth credentials" and paste your Client ID and Client Secret.

<img width="463" alt="Use your own OAuth credentials" src="https://cloud.githubusercontent.com/assets/3598622/22397216/24fe7d88-e56d-11e6-82cf-2d75365d8800.png">

In step 1 on the left, scroll to "Drive API v3", expand it and check the first drive scope.

<img width="488" alt="Check Scopes" src="https://user-images.githubusercontent.com/3598622/28462312-fa4397ea-6e1a-11e7-93ad-365b891052a6.png">

Click "Authorize APIs" and allow access to your account when prompted.
There will be a few warning prompts, just proceed.

When you get to step 2, check "Auto-refresh the token before it expires" and click "Exchange authorization code for tokens".

<img width="493" alt="Exchange authorization code for tokens" src="https://cloud.githubusercontent.com/assets/3598622/22397183/8472095c-e56c-11e6-85be-83adf00837c7.png">

When you get to step 3, click on step 2 again and you should see your **refresh token**.

<img width="487" alt="Refresh Token" src="https://cloud.githubusercontent.com/assets/3598622/22397176/2cef7a98-e56c-11e6-83b9-b4653850dbca.png">

## Getting your Root Folder ID

If you want to store files in your Google Drive root directory, then the folder ID can be `null`. Else go into your Drive and create a folder.

Because Google Drive allows duplicate names, it identifies each file and folder with a unique ID. If you open your folder, you will see the **Folder ID** in the URL.

<img width="807" alt="Folder ID" src="https://cloud.githubusercontent.com/assets/3598622/22397170/d79422ba-e56b-11e6-8ba6-01c622fdef42.png">

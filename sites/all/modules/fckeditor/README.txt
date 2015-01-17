$Id: README.txt,v 1.15.2.1 2007/01/30 12:56:25 ontwerpwerk Exp $

Overview
--------
This module allows Drupal to replace textarea fields with the FCKeditor.
This HTML text editor brings many of the powerful functionalities of
known desktop editors like Word to the web. It's relatively lightweight
and doesn't require any kind of installation on the client computer.

Compatibility
-------------
The integrated File Browser needs a bit of manual configuration,
more information about this in the included readme.txt file

Required components
-------------------
To use FCKeditor in Drupal, you will need to download the FCKeditor
http://www.fckeditor.net/

More information and licence
----------------------------
FCKeditor - The text editor for internet
Copyright (C) 2003-2006 Frederico Caldeira Knabben

Licensed under the terms of the GNU Lesser General Public License:
    http://www.opensource.org/licenses/lgpl-license.php

For further information visit:
    http://www.fckeditor.net/

Requirements
------------
  - Drupal 5.x
  - PHP 4.3.0 or greater
  - FCKeditor 2.3.x (http://www.fckeditor.net/)

Installation
------------
  1. Copy the module fckeditor folder to modules/.
  2. Download FCKeditor 2.x from http://www.fckeditor.net and copy the
     distribution files (the contents of the "fckeditor" directory from
     the FCKeditor distribution file) to modules/fckeditor/fckeditor.
     
     A quick check to see if it is correct: the files 'COPY_HERE.txt',
     'fckconfig.js' and also the directory 'editor' must exist in the
     same directory,
     
  3. See 'How to enable the File Browser' for additional instructions.

     Also read the security note in this readme

     Alternatives to the built-in file browser are the IMCE module and
     copying the image url into the url textfield.

Configuration
-------------
  1. Modify the fckeditor.config.js file to custom your needs (optional).

     You may copy the needed configuration lines from the default FCKeditor
     configuration settings (modules/fckeditor/fckeditor/fckconfig.js),
     the lines in fckeditor.config.js will override most settings.
  
  2. Enable the module as usual from Drupal's admin pages.
  
  3. Under Administer > Settings > FCKeditor, configure the fckeditor
     settings. You can choose which textareas will be replaced by FCKeditor,
     choose the toolbars and configure some more advanced settings.

  4. Grant permissions for use of FCKeditor in
     Administer > User Management > Access Control (You only need to select
     either basic or advanced editor for each role that is allowed to use
     the FCKeditor)

  5. For the Rich Text Editing to work you also need to configure your
     filters for the users that may access Rich Text Editing. Either grant
     those users Full HTML access or use the following:
      <a> <em> <strong> <small> <sup> <sub> <cite> <blockquote> <code>
      <ul> <ol> <li> <dl> <dt> <dd> <h2> <h3> <h4> <img> <br> <br /> <p>
      <div> <span> <b> <i>
     Users that need access to tables might be better of using Full HTML

How to enable the File Browser (in FCKeditor 2.3.x)
---------------------------------------------------
The editor gives the end user the flexibility to create a custom file browser
that can be integrated on it. The included file browser allows users to view
the content of a specific directory on the server and add new content to
that directory (create folders and upload files).

To enable the file browser you need to edit the connector configuration file in
your fckeditor module directory, the file should be in:
/modules/fckeditor/fckeditor/editor/filemanager/browser/default/connectors/php/config.php
and
/modules/fckeditor/fckeditor/editor/filemanager/upload/php/config.php

In this file you will need to enable the file browser:
  $Config['Enabled'] = true ;

To use the drupal files directory you also need to comment out or remove the
following line in the connector configuration:
  $Config['UserFilesPath'] = '/UserFiles/' ;
You may also edit this line to reflect a custom upload path.

Furthermore, you will need to create a "File", "Image", "Flash" and "Media"
subdirectory in your drupal files directory. These directories must have the
same privileges as the drupal files directory. In some cases these
directories must be world writable (chmod 0777).

Security
--------
Note that enabling file uploads is a security risk. That's why there is a
separate permission in Administer > Access Control for enabling the file
browser to certain groups.

Credits
-------
 - FCKeditor for Drupal Core functionality originally written by:
     Frederico Caldeira Knabben
     Jorge Tite (LatPro Inc.)

 - FCKeditor for Drupal 5.x
     Ontwerpwerk (www.ontwerpwerk.nl)

 - FCKeditor - The text editor for internet
     Copyright (C) 2003-2006 Frederico Caldeira Knabben
     http://www.fckeditor.net/

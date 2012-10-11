---
layout: article
title: StratusLab Web Site Design and Branding
category: about
---

StratusLab Background
---------------------

The project initially began as an informal collaboration between CNRS/LAL,
GRNET, SixSq, and UCM. Those institutes plus two additional ones (TID and
TCD), then put together a project proposal that was then funded by the
European Commission. The goal of the project was to create a complete, open
source, Infrastructure-as-a-Service (IaaS) cloud distribution.

The developed software is particularly well adapted for deployment of small or
medium scale cloud infrastructures. A core feature of the software is that it
is easy to install (both the client and cloud services) and easy to use. One
distinguishing feature is the "Marketplace" that allows users to share their
virtual appliances. Appliances in the Marketplace can be easily instantiated
by just knowing the appliance identifier.

More information about StratusLab can be found on the project's current
web site.

Web Site Design
---------------

#Goal

The StratusLab collaboration is moving from a project-based organization to an
open-source community model. We're taking this opportunity to move the web
site to GitHub, along with the code. The overall goal is to create a
streamlined, modern look and layout for the new web site.

#Constraints

The new site will be hosted in GitHub pages and will use Jekyll to
add/maintain the web site. People adding content to the site should only need
to add files in markdown format. A raw skeleton with no real styling is
available. (See links below.)

#Content

Our initial ideas for the content and sections of the web site are:

 * Landing page: General information about the StratusLab goals and software.
   Potentially widgets for twitter and videos.
 * News (or announcements): Containing news items like release announcements
   and StratusLab participation in conferences, etc. 
 * Blog: Longer articles from people in the community concerning particular
   technologies in the StratusLab distribution or evolution of cloud
   technologies in general.
 * Download: Section containing links to the source and binary distributions
   of the software.  Probably also links to release notes for each release.   
 * Documentation: High-level installation and user guides.  Links/widgets to 
   installation and demonstration videos.
 * Contact: Means of contacting the collaboration.  This will probably include
   an email address and invitation to join the google group.

Currently we use Twitter and YouTube. It would be helpful if appropriately
styled widgets were provided/integrated for viewing the twitter feed and any
videos that we put up.

Branding
--------

#Logos & Icons

The project has been running for a bit over two years and some effort has been
put into creating a "brand" around the name and logo. With the new web site, we
would also like to refresh the current logo and color scheme, but still take
advantage of previous dissemination/branding efforts.

We would like a more modern, streamlined color logo while keeping to the
general layout of the current one (prominent collaboration name with clouds to
the right). For technical reasons, we'd like to get rid of the use of color
gradients in the logo. The gradient has caused many problems when printing to
promotional materials and each printer seems to render the logo slightly
differently.

Currently we only have the one logo; we'd also like several variants:

 * Black and white version of the main logo
 * Varient with square aspect ratio for social media, etc.
 * Favicon

Except for the favicon, we'd like to have all of the logos in vector format
(ideally both pdf and svg) and as png bitmaps. Current logos are in GitHub
with the skeleton for the new site (in the logos subdirectory).

#Colors

The only color which is used consistently is the color of the "StratusLab"
text in the logo. This is #143262. Having a well-defined color palette would
help us also with printed materials and making documentation for individual
StratusLab components more consistent.

Existing Resources
------------------

[current web site](http://stratuslab.eu) implemented with dokuwiki

[skeleton of new web site](http://stratuslab.github.com)

[code for skeleton of new web site](https://github.com/StratusLab/stratuslab.github.com)

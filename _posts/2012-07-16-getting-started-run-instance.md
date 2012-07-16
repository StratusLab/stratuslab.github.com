---
layout: article
category: getting-started
title: Simple Client Usage
---

You will find here a few simple instructions to get you going, from installing the command-line client, to configuring your account
and of course starting virtual machines, from a wide range of available images in the Marketplace. 


StratusLab Command-line Client Installation
----

...


User Configuration File
----

User configuration file:

	$ cat ~/.stratuslab/stratuslab-user.cfg
	##############################################################################
	#                                                                            #
	#               StratusLab User Configuration Reference                      #
	#               ---------------------------------------                      #
	#                                                                            #
	#                                                                            #
	#  Note: the [default] section is mandatory. Other sections can be used      #
	#        to override the default section. This allows you to group           #
	#        parameters for different cloud accounts and endpoints, and switch   #
	#        between them using an environment variable, command-line options    #
	#        of the 'selected_section'. Refer to the client help for details     #
	#        (i.e. -h/--help) and online documentation.                          #
	#                                                                            #
	##############################################################################
    
	[default]
	username=<YOUR USERNAME>
	password=<YOUR PASSWORD>
	endpoint=cloud.lal.stratuslab.eu
	#selected_section = my-other-cloud
    
	[my-other-cloud]
	endpoint = cloud.lal.stratuslab.eu
	#username=<YOUR OTHER USERNAME>
	#password=<YOUR OTHER PASSWORD>

Start simple virtual machines
----

Instantiate an image:

	$ stratus-run-instance ...
	

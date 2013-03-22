---
layout: article
title: Logging Design
category: review
---

The global database for the new design allows the virtual machine
logs, which are currently only available by logging into one of the
physical hosts of the cloud, to be made available through the
database.  This allows access by end-users (through CIMI) or by
administrators through the monitoring portal. 

The diagram below shows the general flow of the logging information.

<img width="600px" src="http://stratuslab.eu/img/logging-design.png" />

Essentially, a python logging handler will be created that will log
the events into Couchbase.  This will require the modification of the
StratusLab OpenNebula TM scripts to use logging for indicating
important or exceptional events in the VM's lifecycle.

With the appropriate configuration of the logging, the logging of
events to Couchbase and additionally to a local file will be easy and
transparent for the TM scripts.  Any script that affects a VM can also
be similarly modified to log to the same file.

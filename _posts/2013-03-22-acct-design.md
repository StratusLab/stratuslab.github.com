---
layout: article
title: Accounting Design
category: review
---

The new database-centered architecture allows for a straightforward
implementation of a resource monitoring and accounting service.
Probes installed on the machines hosting virtual machines send usage
information to the global database.  A process on a monitoring host
then periodically reads the current VM resource utilization and
calculated a "bill" with the usage for the period.  These bills can
then be sent to users to advise them of their usage.

The diagram below summarizes the flow for collecting the compute
resource utilization.

<img width="500px" src="http://stratuslab.eu/img/accounting-design.png" />

For each VM host, a cron job will collect the cumulative resource
utilization for each machine and publish that information into the
global database.  A similar task must be executed by (modified)
OpenNebula VM start/stop scripts to ensure that the start information
and full resource utilization are captured.

Similar resource probes will need to be created and run for other
services, such as the storage.  Once the infrastructure is in place
for the compute services, adding other probes should be trivial. 

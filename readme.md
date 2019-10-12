# Goal Tracker 

## What's all this then? 

An API built in Laravel 6 aimed towards allowing users to track their pursuit of life goals. 
It acts as a vehicle for me to get up to speed with Laravel 6, no longer using it professionally after years of 5.x releases.


## Why not Slim/Lumen etc?

Laravel is a great php framework. It is arguably quite heavy and feature dense for something this straightforward. I am familiar with older versions of Laravel, and have found it to be robust and very usable in the past. It is also in demand in industry. Hence choosing it over other full-fat frameworks.

Slim is a fine, bare-bones framework. However, going beyond prototyping, I dislike the amount of work I have to do to stitch in solutions to solved problems. I have also found in the past that when I use Lumen, I usually have to add in so much extra functionality that Laravel provides in the box, that starting with Laravel would have saved time. Hence not choosing a micro-framework. 
 
# Outline of models

## Goals
* Goals are completable
* Goals have multiple steps
* Goals have a creation date
* Goals have an update date
* Goals have notes - CRUDABLE
* Goals can have a deadline or not
* Goals can be considered short/medium/long term
* Goals can be linked

## steps
* Steps can be completable or not (practice is not completable it's ongoign) 
* Steps have a creation/update date
* Steps can have a deadline
* Steps can have progress
* Steps can have notes

## progress
* progress can have notes
* progress has created/updated at
* crud-able
* progress does not have a deadline

## Notes 
* Crud-able
* No completion date
* Creation/Update Date

## General Considerations
* Cascading deletes - parents delete children (how will this impact shared items e.g. one progress existing on two goals)
* Use soft deletes

### MVP Features
* Crud on each model type.
* One to one parent/child relations (can be one to many in the background, just not used)
* Cascading deletes - If I take out a Goal. I want no trace left
* Data validation on api routes
* Graceful error handling.



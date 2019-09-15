A dawn of a new project. 

# Models

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
* Can have multiple parents (copy)

## progress
* progress can have notes
* progress has created/updated at
* crud-able
* progress does not have a deadline
* Can have multiple parents (copy)

## Notes 
* Crud-able
* No completion date
* Creation/Update Date

## General Considerations
* Cascading deletes - parents delete children (how will this impact shared items e.g. one progress existing on two goals)
* Use soft deletes (lumen?)

### MVP
* Crud on each model type.
* One to one parent/child relations (can be one to many in the background, just not used)
* Cascading deletes - If I take out a Goal. I want no trace left
* Data validation on api routes
* Graceful error handling.

### Tech
Laravel/Lumen? Familiar. Get to grips with Lara 5.8. Winner!
Node? - Easy to dev. New experience using mongo etc. Already got one of these. 


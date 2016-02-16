# Pipedrive Test Application
This application has been created as a test for a Backend programmer job in Pipedrive Estonia.

## Database and APP_KEY Setup

Open the .env.example file, change the database configuration with your local data, , save it and rename to .env .

Open you terminal or equivalent shell application and go to your Document Root folder and run the command below:

```
php artisan migrate
```

This will create the database tables in server configurated at .env file.

## Creating a user.

To create a user you must go to localhost/regster.
All fields in the form are required.

After registering you will redirected to a page where contains your API Token.
This token is required to access the API's methods.

## Basic Usage

All API routes must have a valid api_token parameter.
Example: GET http://localhost/api/organization/11?api_token=7b55b5f3b96a19a491b1365514af1a0b

The parameters page and limit are opitional and available only at organization relationships GET by name method.
Example: http://localhost/api/organizationRelationship/Black Banana?page=2&limit=2&api_token=7b55b5f3b96a19a491b1365514af1a0b

The default limit per page are 100.

The POST method that insert many organizations and its relationships must have a JSON file containing the following data:

```JSON
{
    "name": "Paradise Island",
    "daughters": [{
            "name": "Banana tree",
            "daughters": [{
                    "name": "Yellow Banana"

                }, {
                    "name": "Brown Banana"

                }, {
                    "name": "Black Banana"

                }]
        },
        {
            "name": "Big banana tree",
            "daughters": [{
                    "name": "Yellow Banana"

                }, {
                    "name": "Brown Banana"

                }, {
                    "name": "Green Banana"

                }, {
                    "name": "Black Banana",
                    "daughters": [{
                            "name": "Phoneutria Spider"
                        }]

                }]

        }]

}
```
The api will insert only organizations or relationship if it doesn't exist.

The organization route has all CRUD methods and can be accessed as you can see in the following table.


| Verb | Path |	Action | Route Name |
|------|------|--------|------------|
| GET	 | /organization | index |	organization.index |
| POST | /organization |	store |	organization.store |
| GET  | /organization/{organization} |	show | organization.show |
| PUT/PATCH |	/organization/{photo} | update | organization.update |
| DELETE | /organization/{photo} | destroy | organization.destroy |






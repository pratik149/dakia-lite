
# API Documentation

## Table of Contents

#### [Fields](#fields)
- [List All Fields (GET)](#list-all-fields)

#### [Subscribers](#subscribers)
- [List All Subscribers (GET)](#list-all-subscribers)
- [Create New Subscriber (POST)](#create-new-subscriber)
- [View Subscriber (GET)](#view-subscriber)
- [Update Subscriber Details (PUT)](#update-subscriber-details)
- [Delete Subscriber (DELETE)](#delete-subscriber)

# Fields
## List All Fields
#### [GET] [/fields]
+ Response 200 (application/json)

```json
[
  {
    "id": 1,
    "title": "phone",
    "type": "text"
  },
  {
    "id": 2,
    "title": "company",
    "type": "text"
  },
  {
    "id": 3,
    "title": "country",
    "type": "text"
  },
  {
    "id": 4,
    "title": "zip",
    "type": "number"
  },
  {
    "id": 5,
    "title": "birthdate",
    "type": "date"
  }
]
```

# Subscribers

## List All Subscribers
#### [GET] [/subscribers]
+ Response 200 (application/json)

```json
{
  "current_page": 1,
  "data": [
    {
      "id": 93,
      "name": "Creola Bahringer",
      "email": "okunde@example.com",
      "state": "active",
      "created_at": "2022-12-26T09:24:46.000000Z",
      "fields": [
        {
          "id": 1,
          "title": "phone",
          "type": "text",
          "pivot": {
            "subscriber_id": 93,
            "field_id": 1,
            "text_value": "D8o9b1Mxeb",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 3,
          "title": "country",
          "type": "text",
          "pivot": {
            "subscriber_id": 93,
            "field_id": 3,
            "text_value": "gQxIQoUVDE",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 4,
          "title": "zip",
          "type": "number",
          "pivot": {
            "subscriber_id": 93,
            "field_id": 4,
            "text_value": null,
            "number_value": 86630978,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        }
      ]
    },
    {
      "id": 94,
      "name": "Major Blanda II",
      "email": "liam09@example.com",
      "state": "junk",
      "created_at": "2022-12-26T09:24:46.000000Z",
      "fields": [
        {
          "id": 4,
          "title": "zip",
          "type": "number",
          "pivot": {
            "subscriber_id": 94,
            "field_id": 4,
            "text_value": null,
            "number_value": 71429734,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 5,
          "title": "birthdate",
          "type": "date",
          "pivot": {
            "subscriber_id": 94,
            "field_id": 5,
            "text_value": null,
            "number_value": null,
            "date_value": "1996-10-12T00:00:00.000000Z",
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        }
      ]
    },
    {
      "id": 95,
      "name": "Orlo Bogan",
      "email": "ariel.corwin@example.net",
      "state": "unconfirmed",
      "created_at": "2022-12-26T09:24:46.000000Z",
      "fields": [
        {
          "id": 1,
          "title": "phone",
          "type": "text",
          "pivot": {
            "subscriber_id": 95,
            "field_id": 1,
            "text_value": "ZeUaCPinfd",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 4,
          "title": "zip",
          "type": "number",
          "pivot": {
            "subscriber_id": 95,
            "field_id": 4,
            "text_value": null,
            "number_value": 48581689,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 5,
          "title": "birthdate",
          "type": "date",
          "pivot": {
            "subscriber_id": 95,
            "field_id": 5,
            "text_value": null,
            "number_value": null,
            "date_value": "1986-10-26T00:00:00.000000Z",
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        }
      ]
    },
    {
      "id": 96,
      "name": "Emmitt Hills",
      "email": "ygorczany@example.org",
      "state": "bounced",
      "created_at": "2022-12-26T09:24:46.000000Z",
      "fields": [
        {
          "id": 1,
          "title": "phone",
          "type": "text",
          "pivot": {
            "subscriber_id": 96,
            "field_id": 1,
            "text_value": "caWR9ndULD",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 4,
          "title": "zip",
          "type": "number",
          "pivot": {
            "subscriber_id": 96,
            "field_id": 4,
            "text_value": null,
            "number_value": 60563400,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 5,
          "title": "birthdate",
          "type": "date",
          "pivot": {
            "subscriber_id": 96,
            "field_id": 5,
            "text_value": null,
            "number_value": null,
            "date_value": "1992-10-15T00:00:00.000000Z",
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        }
      ]
    },
    {
      "id": 97,
      "name": "Candida Morissette Mob",
      "email": "renner.tremayne@yahoo.com",
      "state": "junk",
      "created_at": "2022-12-26T09:24:46.000000Z",
      "fields": [
        {
          "id": 1,
          "title": "phone",
          "type": "text",
          "pivot": {
            "subscriber_id": 97,
            "field_id": 1,
            "text_value": "j7a6ir7wpj",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 2,
          "title": "company",
          "type": "text",
          "pivot": {
            "subscriber_id": 97,
            "field_id": 2,
            "text_value": "xNnd1YJbra",
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 4,
          "title": "zip",
          "type": "number",
          "pivot": {
            "subscriber_id": 97,
            "field_id": 4,
            "text_value": null,
            "number_value": 79405285,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:24:47.000000Z"
          }
        },
        {
          "id": 5,
          "title": "birthdate",
          "type": "date",
          "pivot": {
            "subscriber_id": 97,
            "field_id": 5,
            "text_value": null,
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:24:47.000000Z",
            "updated_at": "2022-12-26T09:31:21.000000Z"
          }
        },
        {
          "id": 3,
          "title": "country",
          "type": "text",
          "pivot": {
            "subscriber_id": 97,
            "field_id": 3,
            "text_value": null,
            "number_value": null,
            "date_value": null,
            "boolean_value": null,
            "created_at": "2022-12-26T09:31:21.000000Z",
            "updated_at": "2022-12-26T09:31:21.000000Z"
          }
        }
      ]
    },
  ],
  "first_page_url": "https://projects.pratikrane.com/api/subscribers?page=1",
  "from": 1,
  "last_page": 20,
  "last_page_url": "https://projects.pratikrane.com/api/subscribers?page=20",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=1",
      "label": "1",
      "active": true
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=2",
      "label": "2",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=3",
      "label": "3",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=4",
      "label": "4",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=5",
      "label": "5",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=6",
      "label": "6",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=7",
      "label": "7",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=8",
      "label": "8",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=9",
      "label": "9",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=10",
      "label": "10",
      "active": false
    },
    {
      "url": "https://projects.pratikrane.com/api/subscribers?page=2",
      "label": "Next &raquo;",
      "active": false
    }
  ],
  "next_page_url": "https://projects.pratikrane.com/api/subscribers?page=2",
  "path": "https://projects.pratikrane.com/api/subscribers",
  "per_page": 5,
  "prev_page_url": null,
  "to": 5,
  "total": 99
}
```

## Create New Subscriber 
#### [POST] [/subcribers]

+ Request (application/json)
```json
{
  "email": "okunde@gmai.com",
  "name": "Creola Bahringer",
  "state": "active",
  "fields": [
    {
      "id": 1,
      "title": "phone",
      "type": "text",
      "value": "D8o9b1Mxeb"
    },
    {
      "id": 2,
      "title": "company",
      "type": "text",
      "value": null
    },
    {
      "id": 3,
      "title": "country",
      "type": "text",
      "value": "gQxIQoUVDE"
    },
    {
      "id": 4,
      "title": "zip",
      "type": "number",
      "value": 86630978
    },
    {
      "id": 5,
      "title": "birthdate",
      "type": "date",
      "value": null
    }
  ]
}
```

## View Subscriber 
#### [GET] [/subscribers/{subscriber_id}]

+ Parameters
    + subscriber_id (number) - ID of the Subscriber in the form of an integer

```json
{
  "id": 1,
  "name": "Blair Stoltenberg",
  "email": "mona.stiedemann@example.net",
  "state": "active",
  "created_at": "2022-12-26T09:24:45.000000Z",
  "fields": [
    {
      "id": 3,
      "title": "country",
      "type": "text",
      "pivot": {
        "subscriber_id": 1,
        "field_id": 3,
        "text_value": "qIx3txkVwj",
        "number_value": null,
        "date_value": null,
        "boolean_value": null,
        "created_at": "2022-12-26T09:24:46.000000Z",
        "updated_at": "2022-12-26T09:24:46.000000Z"
      }
    },
    {
      "id": 5,
      "title": "birthdate",
      "type": "date",
      "pivot": {
        "subscriber_id": 1,
        "field_id": 5,
        "text_value": null,
        "number_value": null,
        "date_value": "2010-08-12T00:00:00.000000Z",
        "boolean_value": null,
        "created_at": "2022-12-26T09:24:46.000000Z",
        "updated_at": "2022-12-26T09:24:46.000000Z"
      }
    }
  ]
}
```

## Update Subscriber Details
#### [PUT] [/subcribers/{subscriber_id}]

+ Parameters
    + subscriber_id (number) - ID of the Subscriber in the form of an integer

+ Request (application/json)
```json
{
  "email": "okunde@gmail.com",
  "name": "Creola Bahringer",
  "state": "active",
  "fields": [
    {
      "id": 1,
      "title": "phone",
      "type": "text",
      "value": "+919838737623"
    },
    {
      "id": 2,
      "title": "company",
      "type": "text",
      "value": null
    },
    {
      "id": 3,
      "title": "country",
      "type": "text",
      "value": "Japan"
    },
    {
      "id": 4,
      "title": "zip",
      "type": "number",
      "value": 4102049
    },
    {
      "id": 5,
      "title": "birthdate",
      "type": "date",
      "value": null
    }
  ]
}
```

## Delete Subscriber 
#### [DELETE] [/subscribers/{subscriber_id}]

+ Parameters
    + subscriber_id (number) - ID of the Subscriber in the form of an integer

+ Response 204

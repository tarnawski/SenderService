SenderService
=============
It's self learning project to get knowledge with microservices. 

This application is part of architectural services consisting of:
- SenderService (this)
- EmailService `https://github.com/tarnawski/EmailService.git`
- Kafka `https://github.com/tarnawski/KafkaService.git`

## Flow:    

1. When new email appear in EmailService microservice
2. EmailService automatically report status "CHANGED" to Kafka
3. SenderService react to status "CHANGED" from Kafka and synchronize local database
3. SenderService send email message to new emails in database

But it can be a stand-alone service for sending e-mails from the fetched address list

###Getting started

In order to set up this application you need clone this repo:

```git clone https://github.com/tarnawski/SenderService.git```

And you have to install dependencies:

```
cd senderservice

composer install
```


####2. Run with Vagrant and prepared environment:

```
cd vagrant && vagrant up 
```


When the process is complete, get into the machine:
```
vagrant ssh
cd /var/www/emailservice/
```


#### Do you like Docker? Me too!

Just run this command in project catalog:
```
docker-compose run
```


How it works?
=============

To fetch data with email you must set property: `email_service_host` - it's the endpoint returned email list in JSON format, for example:
```
[
    {
        "id":1,
        "email":"email1@example.pl"
    },
    {
        "id":2,
        "email":"email2@example.pl"
    }
]
```
It is important that the response should contain  property `email`

You can use following commands:
 `emailservice:synchronize` - to synchronize local database with addresses email fetch from external service
 `emailservice:send` - to send emails to address stored in db

     
Apache Kafka implement
======================

This microservice is adapted to work with Apache Kafka. 

To enable connection you must set a few parameters:
```
kafka_enable 
kafka_host
kafka_port
kafka_topic
```

By default connection is disabled.

Repository with Apache Kafka and Zookeeper:
```
https://github.com/tarnawski/kafka.git
```
// App for testing out mongodb
require('dotenv').config();
// This was suggested by w3 schools
//var MongoClient = require('mongodb').MongoClient;
// This was on the free code camp page
//const mongoose=require('mongodb');

const { MongoClient } = require('mongodb');

var url = process.env.MONGO_URI;

async function main(){
    const client=new MongoClient(url);
    try{
        await client.connect();
        await listDatabases(client);
        console.log("Connected to database!");
    }catch(e){
        console.error(e);
    }finally{
        await client.close()
    }
}

async function listDatabases(client){
    const databasesList=await client.db().admin().listDatabases();
    console.log("Databases:");
    databasesList.databases.forEach(db=>{
        console.log('- ${db.name}');
    })
}

main().catch(console.error);
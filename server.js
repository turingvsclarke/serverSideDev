const express=require('express')
const app=express();
const bodyParser=require('body-parser');

let tasks=[];

app.listen(5000);

app.use('/',bodyParser({extended:true}));

app.use('/public',express.static(__dirname+'/public'));

app.get('/',function(req,res){
    //res.json({name:"Baxter",age:"dead"});
    res.sendFile(__dirname+"/views/index.html");
});

app.post('/task',function(req,res){
    console.log(req.body);
    tasks.push({taskName:req.body.task,taskDate:req.body.date});
    console.log(tasks);
    res.sendFile(__dirname+"/views/taskList.html");
})

exports=tasks;

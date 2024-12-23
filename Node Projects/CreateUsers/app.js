const express = require('express');
const app = express();
const path = require('path');
const userModel = require('./models/users');
const { name } = require('ejs');

app.set('view engine', 'ejs');

app.use(express.json());
app.use(express.urlencoded({extended:true}));

app.use(express.static(path.join(__dirname, 'public')));



app.get('/', (req, res)=>{
  res.render("index");
});

app.get('/show', async(req, res)=>{
  let userdata = await userModel.find();
  res.render("show", {users : userdata});
});
app.post('/create', async (req, res)=>{
  let {name, email, image} = req.body;
  let createUser = await userModel.create({
    name,
    email,
    image
  });
  res.redirect('/show');

})


app.get('/delete/:id', async (req, res)=>{
  let id = req.params.id;
  await userModel.findOneAndDelete({
    _id: id
  })
  res.redirect('/show');
})

app.get('/edit/:userid', async (req, res)=>{
  let userid = req.params.userid;
  let users = await userModel.findOne({_id: userid});
  res.render("edit", { user: users});
})
app.post('/update/:userid', async (req, res)=>{
  let userid = req.params.userid;
  await userModel.findOneAndUpdate({_id: userid}, {
    name: req.body.name,
    email: req.body.email,
    image: req.body.image
  },{new:true});
  res.redirect("/");
})

app.listen(2000);
const express = require("express");
const app = express();
const path = require("path");
const userModel = require("./models/user");
const postModel = require("./models/post");
const cookieParser = require("cookie-parser");
const bcrypt = require("bcrypt");
const jwt = require('jsonwebtoken');
const multerconfig = require("./config/multerconfig");





app.set("view engine", "ejs");
app.use(express.json());
app.use(express.urlencoded({extended: true}));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));





app.get('/', (req, res)=>{
  res.render("index", {message: ''});
})

app.get('/profile/upload', (req, res)=>{
  res.render("profileupload");

})

app.post('/upload',isLoggedIn, multerconfig.single('image'), async (req, res)=>{
  let user = await userModel.findOne({email:req.user.email});
  user.profilepic = req.file.filename;
  await user.save();

  res.redirect('/profile');

})
app.get('/profile', isLoggedIn, async (req, res)=>{
  
  let user = await userModel.findOne({email: req.user.email, _id: req.user.userid}).populate("posts");
 
  // console.log(user);
  res.render("profile", {user});
});

app.get('/like/:id', isLoggedIn, async (req, res)=>{
  
  let post = await postModel.findOne({_id: req.params.id}).populate("user");
  if(post.likes.indexOf(req.user.userid)=== -1){
    post.likes.push(req.user.userid);
  }else{
    post.likes.splice(post.likes.indexOf(req.user.userid), 1);
  }
  await post.save();
  // console.log(user);
  res.redirect("/profile");
});

app.get('/edit/:id', isLoggedIn, async (req, res)=>{
  
  let post = await postModel.findOne({_id: req.params.id}).populate("user");
  
  res.render("edit", {post});
});

app.post('/update/:id', async (req, res)=>{
  let {content} = req.body;
  let post = await postModel.findOneAndUpdate({_id: req.params.id}, {
    content
  });
  res.redirect("/profile");
})

app.post('/post', isLoggedIn, async (req, res)=>{
  
  let user = await userModel.findOne({email: req.user.email, _id: req.user.userid});
  let {content} = req.body;
  let post = await postModel.create({
    user:user._id,
    content
  });
  user.posts.push(post._id);
  await user.save();
  res.redirect('/profile');
});


app.post('/register', async (req, res)=>{
  let {email, password, username, name, age} =req.body;
  
  let user = await userModel.findOne({email});
  if (user) { 
    res.status(500).render('index', {message: 'User Already Existed'});
  } else { 
    bcrypt.genSalt(10, (err, salt)=>{
      bcrypt.hash(password, salt, async (err, hash)=>{
        let user = await userModel.create({
          username, 
          name, 
          age, 
          email,
          password: hash
        });
        let token = jwt.sign({email: email, userid : user._id}, "shhoroehqhiu");
        res.cookie("token", token);
        
        res.render("index", {message: 'Successfully Registered'})
      })
    })}

})

app.get('/login', (req, res)=>{
  res.render('login', {message: ''});

})

app.post('/login', async (req, res)=>{
  let {email, password} =req.body;
  
  let user = await userModel.findOne({email});
  if (!user) { 
    res.status(500).render('login', {message: 'Something Went Wrong'});
  } 
  bcrypt.compare(password, user.password, function(err, result){
    if(result == true) {
      let token = jwt.sign({email: email, userid : user._id}, "shhoroehqhiu");
        res.cookie("token", token);
      res.status(200).redirect('/profile');
        
      } else{
        res.redirect("/login");

      }
    
  })

})

app.get('/logout', (req, res)=>{
  res.cookie("token", "");
  res.redirect('/login');

})

function isLoggedIn(req, res, next){
  if(req.cookies.token===""){ return res.redirect( "/login");}
  else{
    let decoded = jwt.verify(req.cookies.token, "shhoroehqhiu");
    req.user = decoded;
  }
  next();
}

app.listen(3000);
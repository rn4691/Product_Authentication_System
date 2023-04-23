const express = require("express");
const path = require("path");
const bodyParser = require("body-parser");
const knex = require("knex");

const db = knex({
  client: "pg",
  connection: {
    host: "127.0.0.1",
    user: "postgres",
    password: "India@123",
    database: "loginform",
  },
});
//doing
const { Client } = require("pg");
const client = new Client({
  host: "localhost",
  user: "postgres",
  password: "India@123",
  database: "loginform",
});
client.connect();
client.query("select * from product where id=1", (err, res) => {
  if (!err) {
    console.log(res.rows);
  } else {
    console.log("Error:" + err.message);
  }
  client.end;
});
const app = express();

let intialPath = path.join(__dirname, "public");

app.use(bodyParser.json());
app.use(express.static(intialPath));

app.get("/register", (req, res) => {
  res.sendFile(path.join(intialPath, "register.html"));
});
app.get("/login", (req, res) => {
  res.sendFile(path.join(intialPath, "login.html"));
});

app.get("/product", (req, res) => {
  res.sendFile(path.join(intialPath, "product.html"));
});

app.get("/", (req, res) => {
  res.sendFile(path.join(intialPath, "index.html"));
});
app.post("/register-user", (req, res) => {
  const { name, email, password } = req.body;

  if (!name.length || !email.length || !password.length) {
    res.json("fill all the fields");
  } else {
    db("admin")
      .insert({
        name: name,
        email: email,
        password: password,
      })
      .returning(["name", "email"])
      .then((data) => {
        res.json(data[0]);
      })
      .catch((err) => {
        console.log(err);
        // if (err.detail.includes("already exists")) {
        res.json("email already exists");
        // }
      });
  }
});

app.post("/login-user", (req, res) => {
  const { email, password } = req.body;

  db.select("name", "email")
    .from("admin")
    .where({
      email: email,
      password: password,
    })
    .then((data) => {
      if (data.length) {
        res.json(data[0]);
      } else {
        res.json("email or password is incorrect");
      }
    });
});

app.post("/product-user", (req, res) => {
  console.log(req.body);
  const { pname, email, unique_code, colour, size, country } = req.body;

  if (
    !pname.length ||
    !email.length ||
    !unique_code.length ||
    !colour.length ||
    !size.length ||
    !country.length
  ) {
    res.json("fill all the fields");
  } else {
    db("product")
      .insert({
        pname: pname,
        email: email,
        unique_code: unique_code,
        colour: colour,
        size: size,
        country: country,
      })
      .returning(["pname", "email", "unique_code", "colour", "size", "country"])
      .then((data) => {
        res.json(data[0]);
      })
      .catch((err) => {
        console.log(err);
        // if (err.detail.includes("already exists")) {
        //res.json("product already exists");
        // }
      });
  }
});

app.listen(3000, (req, res) => {
  console.log("listening on port 3000......");
});
// <!-- const db = knex({ client: "pg", connection: { host: "127.0.0.1", user:
// "postgres", password: "India@123", database: "loginform", }, });
// app.get("/product", (req, res) => { res.sendFile(path.join(intialPath,
// "product.html")); }); admin error log -->
//array fetch

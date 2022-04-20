import React from "react";
import ReactDOM from "react-dom";
import * as serviceWorker from "./serviceWorker";
import { Routing } from "./constants/Routes";
import Layout from "./containers/Layout";

// This is the entry point for the app.
ReactDOM.render(
  <Layout>
    <Routing></Routing>
  </Layout>,
  document.getElementById("root")
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();

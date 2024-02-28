import React from "react";
import "tailwindcss/tailwind.css";
import "./index.css";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import QuestionsCreatorComponent from "./QuestionsCreator";

ReactDOM.createRoot(document.getElementById("creadorPreguntas")).render(
  <React.StrictMode>
    <BrowserRouter>
      <QuestionsCreatorComponent />
    </BrowserRouter>
  </React.StrictMode>
);

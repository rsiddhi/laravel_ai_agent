import React from "react";
import ReactDOM from "react-dom/client";
import AgentApp from "./components/AgentApp";

const el = document.getElementById("agent-root");

if (el) {
    ReactDOM.createRoot(el).render(<AgentApp />);
}
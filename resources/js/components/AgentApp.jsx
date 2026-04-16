import { useState } from "react";
import axios from "axios";

export default function AgentApp() {
    const [goal, setGoal] = useState("");
    const [steps, setSteps] = useState([]);
    const [loading, setLoading] = useState(false);

    const runAgent = async () => {
        setLoading(true);
        setSteps([]);

        const res = await axios.post("/api/agent/run", { goal });

        setSteps(res.data);
        setLoading(false);
    };

    return (
        <div>
            <h1>AI Agent</h1>

            <textarea
                value={goal}
                onChange={(e) => setGoal(e.target.value)}
                placeholder="Enter goal"
            />

            <br /><br />

            <button onClick={runAgent}>
                {loading ? "Running..." : "Run Agent"}
            </button>

            <hr />

            {steps.map((step, i) => (
                <div key={i}>
                    <b>Action:</b> {step.action} <br />
                    <b>Result:</b> {step.result}
                    <hr />
                </div>
            ))}
        </div>
    );
}
import { useState } from "react";
import { request } from "../../utils/axios";
import { requestMethods } from "../../utils/request_methods";
import { Link, useNavigate } from "react-router";

import './index.css'
const Login = () => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const [form, setForm] = useState({
                                email: "",
                                password: ""
                            })
    const navigate = useNavigate();
    const login = async(e) =>{
        e.preventDefault();
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'login',
            body: form,
            });
            if (!response.error) {
            console.log(response);
            localStorage.setItem("access_token", response.user.token);
            console.log(localStorage.getItem("access_token"));
            navigate("/");   
            } else {
                console.log(response.message);
                alert("Email and Password Mismatch")
            }
            setForm({
                email: "",
                password:""
            })
    }
    return(
        <div className="login">
            <form >
                <div>
                    <label htmlFor="email">Email</label>
                    <input type="email" value={form.email} 
                    onChange={(e) => { setForm({
                                        ...form,
                                        email: e.target.value,
                                        });
                                    }
                    }
                    name="email" placeholder="example@server.com"/>
                </div>

                <div>
                    <label htmlFor="password">Password</label>
                    <input type="password" value={form.password}
                    onChange={(e) => { setForm({
                                        ...form,
                                        password: e.target.value,
                                        });
                                    }
                    }
                    name="password" placeholder="Password"/>
                </div>

                <button onClick={(e)=>login(e)}>Login</button>

                <p>Don't have an account <Link to="/signup">Signup</Link></p>
            </form>
        </div>
    );
}
export default Login
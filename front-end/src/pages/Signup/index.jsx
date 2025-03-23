import { useState } from "react";
import { request } from "../../utils/axios";
import { requestMethods } from "../../utils/request_methods";
import { Link, useNavigate } from "react-router";

import './index.css'
const Signup = () => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const [form, setForm] = useState({
                                email: "",
                                password: "",
                                name:""
                            })
    const navigate = useNavigate();
    const signup = async(e) =>{
        e.preventDefault();
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'signup',
            body: form,
            });
            if (!response.error) {
                console.log(response);
                navigate("/login");
            } else {
                console.log(response);
                alert(response.error)
            }
            setForm({
                email: "",
                password:"",
                name:""
            })
    }
    return(
        <div className="signup">
            <form >
            <div>
                    <label htmlFor="user_name">Name</label>
                    <input type="text" value={form.name}
                    onChange={(e) => { setForm({
                                        ...form,
                                        name: e.target.value,
                                        });
                                    }
                    }
                    name="password" placeholder="Joe"/>
                </div>

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

                <button onClick={(e)=>signup(e)}>Signup</button>

                <p>Already have an account <Link to="/login">Login</Link></p>
            </form>
        </div>
    );
}
export default Signup
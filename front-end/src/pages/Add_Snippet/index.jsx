import { useState } from "react";
import { request } from "../../utils/axios";
import { requestMethods } from "../../utils/request_methods";
import { Link, useNavigate } from "react-router";

import './index.css'
const Add_Snippet = () => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const [form, setForm] = useState({
                                title: "",
                                content: "",
                                language: "",
                                tags:""
                            })
    const navigate = useNavigate();
    const add = async(e) =>{
        e.preventDefault();
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'add_update_snippet',
            body: form,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("access_token"),
            },
            });
            if (!response.error) {
                console.log(response);
                navigate("/");   
            } else {
                console.log(response.message);
                alert("Not added")
            }
            setForm({
                title: "",
                content: "",
                language: "",
                tags:""
            })
    }
    return(
        <div className="add">
            <form >
                <div>
                    <label htmlFor="title">Title</label>
                    <input type="text" value={form.title} 
                    onChange={(e) => { setForm({
                                        ...form,
                                        title: e.target.value,
                                        });
                                    }
                    }
                    name="title" placeholder="for loop"/>
                </div>

                <div>
                    <label htmlFor="content">Content</label>
                    <input type="text" value={form.content}
                    onChange={(e) => { setForm({
                                        ...form,
                                        content: e.target.value,
                                        });
                                    }
                    }
                    name="content" placeholder="for i in range(10):"/>
                </div>

                <div>
                    <label htmlFor="language">Language</label>
                    <input type="text" value={form.language}
                    onChange={(e) => { setForm({
                                        ...form,
                                        language: e.target.value,
                                        });
                                    }
                    }
                    name="language" placeholder="python"/>
                </div>

                <div>
                    <label htmlFor="tags">Tags</label>
                    <input type="text" value={form.tags}
                    onChange={(e) => { setForm({
                                        ...form,
                                        tags: e.target.value,
                                        });
                                    }
                    }
                    name="tags" placeholder="#java #print"/>
                </div>

                <button onClick={(e)=>add(e)}>add</button>

            </form>
        </div>
    );
}
export default Add_Snippet
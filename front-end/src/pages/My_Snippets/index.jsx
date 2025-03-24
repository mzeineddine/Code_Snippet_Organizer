import { useEffect, useState } from "react";
import { request } from "../../utils/axios";
import { requestMethods } from "../../utils/request_methods";
import Code_Snippet_Mine from "../../components/Code_Snippet_Mine"
const My_Snippets = () => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const [snippets, setSnippets] = useState([]);
    const get_snippets = async() =>{
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'get_my_Snippets',
            headers: {
                Authorization: "Bearer " + localStorage.getItem("access_token"),
            },
        });
        if (!response.error) {
            console.log(response.snippets);
            setSnippets(response.snippets)

        } else {
            console.log(response);
            alert("Deletion Succeed")
        }
    }
    useEffect(() => {
        get_snippets()
    }, []);
    return(
        <div className="home">
            {
                snippets.map((snippet, index) => {
                    return <Code_Snippet_Mine key={index} snippet={snippet}/>
                })
            }
        </div>
    );

}
export default My_Snippets
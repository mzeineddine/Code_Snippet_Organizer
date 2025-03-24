import { Navigate, useNavigate } from 'react-router';
import { request } from '../../utils/axios';
import { requestMethods } from '../../utils/request_methods';
import './index.css'
const Code_Snippet_Mine = ({snippet}) => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const formdata = new FormData();
    formdata.append("id",snippet.id)
    const deleteSnippet = async() => {
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'delete_snippet',
            headers: {
                Authorization: "Bearer " + localStorage.getItem("access_token"),
            },
            body: formdata
        });
        if (!response.error) {
            console.log(response.favorite);
        } else {
            console.log(response);
            alert(response.error)
        }
    }

    const navigate = useNavigate();
    const editSnippet = () => {
        navigate("/edit_snippet", { state: { snippet } });
    }
    return(
        <div className="snippet_code_mine">
            <div className='title'>Title: {snippet.title}</div>
            <div className='content'>{snippet.content}</div>
            <div className='language'>Language: {snippet.language}</div>
            <div>
                <button onClick={(e)=> deleteSnippet(e)}>Delete</button>
                <button onClick={(e)=> editSnippet(e)}>Edit</button>
            </div>
        </div>
    )
}
export default Code_Snippet_Mine
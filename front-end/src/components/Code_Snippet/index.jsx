import { request } from '../../utils/axios';
import { requestMethods } from '../../utils/request_methods';
import './index.css'
const Code_Snippet = ({snippet}) => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";
    const formdata = new FormData();
    formdata.append("snippet_id",snippet.id)
    const addToFavorite = async() => {
        const response = await request({
            method: requestMethods.POST,
            route: base_url + 'add_favorite',
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
    return(
        <div className="snippet_code">
            <div className='title'>Title: {snippet.title}</div>
            <div className='content'>{snippet.content}</div>
            <div className='language'>Language: {snippet.language}</div>
            <button onClick={(e)=> addToFavorite(e)}>Add to favorite</button>
        </div>
    )
}
export default Code_Snippet
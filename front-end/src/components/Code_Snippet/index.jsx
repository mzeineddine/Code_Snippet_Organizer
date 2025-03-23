import './index.css'
const Code_Snippet = ({snippet}) => {
    console.log({snippet})
    return(
        <div className="snippet_code">
            <div className='title'>Title: {snippet.title}</div>
            <div className='content'>{snippet.content}</div>
            <div className='language'>Language: {snippet.language}</div>
        </div>
    )
}
export default Code_Snippet
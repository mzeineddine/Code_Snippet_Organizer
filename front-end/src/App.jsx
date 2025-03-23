import {Routes, Route} from 'react-router-dom'
import './App.css'

function App() {

  return (
    <>
      <Routes>
        <Route path="/auth" element={<Auth />} />
          <Route path='/' element={<Login />}/>
          <Route path='/signup' element={<Signup />}/>
          <Route element={<ProtectedRoute />}>
            <Route path="/" element={<Home />} />
            <Route path="/add_snippet" element={<Add_Snippet/>} />
            <Route path="/favorite_snippet" element={<Favorite_Snippet/>} />
          </Route>
      </Routes>
    </>
  )
}

export default App

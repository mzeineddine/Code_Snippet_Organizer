import {Routes, Route} from 'react-router-dom'
import ProtectedRoute from './components/ProtectedRoute'

import Home from './pages/Home'
import Login from './pages/Login'
import Signup from './pages/Signup'
import NavBar from "./components/NavBar"
import Add_Snippet from "./pages/Add_Snippet"
import Favorite_Snippet from "./pages/Favorite_Snippet"

import './styles/App.css'
import My_Snippets from './pages/My_Snippets'

function App() {
  return (
    <>
      <NavBar />
      <Routes>
        {/* <Route path="/auth" element={<Auth />} /> */}
        <Route path='/login' element={<Login />}/>
        <Route path='/signup' element={<Signup />}/>
        <Route element={<ProtectedRoute />}>
          <Route path="/" element={<Home />} />
          <Route path="/add_snippet" element={<Add_Snippet/>} />
          <Route path='my_snippet' element={<My_Snippets/>} />
          <Route path="/favorite_snippet" element={<Favorite_Snippet/>} />
        </Route>
      </Routes>
    </>
  )
}

export default App

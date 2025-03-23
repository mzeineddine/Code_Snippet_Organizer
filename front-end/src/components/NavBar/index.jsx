import { Link } from "react-router-dom";
import './index.css'
const NavBar = () => {
    return (
        <nav className="navbar">
        <ul className="nav-links">
            <li><Link to="/">Home</Link></li>
            <li><Link to="/add_snippet">Add</Link></li>
            <li><Link to="/favorite_snippet">Favorite</Link></li>
        </ul>
        </nav>
    );
};

export default NavBar;
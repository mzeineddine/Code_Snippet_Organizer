import { useEffect, useState } from "react";
import {request} from "../../utils/axios"
import {requestMethods} from '../../utils/request_methods'
import { Navigate, Outlet } from "react-router";
const ProtectedRoute = () => {
    const base_url = "http://127.0.0.1:8000/api/v0.1/";

    const [loading, setLoading] = useState(true);
    const [isAuth, setIsAuth] = useState(false);

    const validateToken = async (token) => {
        const response = await request({
            method: requestMethods.GET,
            route: base_url + "validate-token",
            headers: {
                Authorization: "Bearer " + token,
            },
        });
        if (!response.success) {
            setLoading(false);
            setIsAuth(false);
            localStorage.clear();
        } else {
            setLoading(false);
            setIsAuth(true);
        }
    }

    useEffect(() => {
        const token = localStorage.getItem("access_token");
        if (!token) {
            setLoading(false);
            setIsAuth(false);
            localStorage.clear();
        } else {
            validateToken(token);
        }
    }, []);
    
    return loading ? (<p>Loading</p>) 
                    : isAuth ? (<Outlet />) 
                                : (<Navigate to="/login" />);

}
export default ProtectedRoute
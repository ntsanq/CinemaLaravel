import * as React from 'react';
import {AppBar, ToggleThemeButton, defaultTheme} from 'react-admin';
import Box from '@mui/material/Box';
import {Button} from "antd";
import {createTheme} from "@mui/material";

export default function AdminBar(props) {
    const handleLogout = () => {
        window.location.href = `/admin/logout`;
    }

    const darkTheme = createTheme({
        palette: { mode: 'dark' },
    });

    return (
        <AppBar color="primary">
            <div>{props.user}</div>
            <Box flex="1"/>
            <Box flex="1"/>
            <Button type="text" style={{color: "white"}} onClick={handleLogout}>Log out</Button>
            <ToggleThemeButton lightTheme={defaultTheme} darkTheme={darkTheme} />
        </AppBar>
    );
};

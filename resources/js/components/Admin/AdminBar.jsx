import * as React from 'react';
import {AppBar} from 'react-admin';
import Box from '@mui/material/Box';
import {Button} from "antd";

export default function AdminBar() {
    const handleLogout = () => {
        window.location.href = `/admin/logout`;
    }

    return (
        <AppBar color="primary">
            <Box flex="1"/>
            <Box flex="1"/>
            <Button type="text" style={{color: "white"}} onClick={handleLogout}>Log out</Button>
        </AppBar>
    );
};

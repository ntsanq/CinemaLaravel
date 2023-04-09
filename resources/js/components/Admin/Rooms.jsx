import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, UrlField
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
export const RoomIcon = BookIcon;

export const RoomList = () => {
    return (
        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <UrlField source="name"/>
                <UrlField source="status" disabled/>
                <EditButton basePath=""/>
            </Datagrid>
        </List>
    )
};

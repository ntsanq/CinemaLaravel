import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const RoomIcon = BookIcon;

export const RoomList = () => {
    return (
        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <TextField source="status" disabled/>
                <EditButton basePath=""/>
            </Datagrid>
        </List>
    )
};

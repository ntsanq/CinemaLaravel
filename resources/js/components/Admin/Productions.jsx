import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const ProductionIcon = BookIcon;

export const ProductionList = () => {
    return (
        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton />
            </Datagrid>
        </List>
    )
};

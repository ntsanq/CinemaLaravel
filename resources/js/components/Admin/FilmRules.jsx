import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, UrlField
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
export const FilmRuleIcon = BookIcon;

export const FilmRuleList = () => {
    return (
        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <UrlField source="name"/>
                <EditButton basePath=""/>
            </Datagrid>
        </List>
    )
};

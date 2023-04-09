import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const FilmRuleIcon = BookIcon;

export const FilmRuleList = () => {
    return (
        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton basePath=""/>
            </Datagrid>
        </List>
    )
};

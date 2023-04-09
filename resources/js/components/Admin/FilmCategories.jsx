import * as React from "react";
import {
    List,
    Datagrid,
    Edit,
    Create,
    SimpleForm,
    DateField,
    TextField,
    EditButton,
    TextInput,
    DateInput,
    useRecordContext, ImageField, Link, ArrayField, SingleFieldList, ChipField, SimpleList, EmailField, UrlField
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
export const FilmCategoryIcon = BookIcon;

export const FilmCategoryList = () => {
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

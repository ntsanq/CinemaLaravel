import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, useRecordContext, Edit, TextInput, SimpleForm, Create, Pagination,
} from 'react-admin';
import CategoryIcon from '@mui/icons-material/Category';

export const FilmCategoryIcon = CategoryIcon;
const FilmCategoryPagination = () => <Pagination rowsPerPageOptions={[5, 10, 25, 50]}/>;

const filmCategoryFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];
export const FilmCategoryList = () => {
    return (
        <List filters={filmCategoryFilters} pagination={<FilmCategoryPagination/>}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};

const FilmCategoryTitle = () => {
    const record = useRecordContext();
    return <span>Film category{record ? `: ${record.name}` : ''}</span>;
};
export const FilmCategoryEdit = () => (
    <Edit title={<FilmCategoryTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
            <EditButton/>
        </SimpleForm>
    </Edit>
);

export const FilmCategoryCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
);


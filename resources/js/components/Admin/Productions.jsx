import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, useRecordContext, TextInput, Edit, SimpleForm, Create
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const ProductionIcon = BookIcon;

const productionFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];
export const ProductionList = () => {
    return (
        <List filters={productionFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};

const ProductionTitle = () => {
    const record = useRecordContext();
    return <span>Production{record ? `: ${record.name}` : ''}</span>;
};
export const ProductionEdit = () => (
    <Edit title={<ProductionTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Edit>
)
export const ProductionCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
)

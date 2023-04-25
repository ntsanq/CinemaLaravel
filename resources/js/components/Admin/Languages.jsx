import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, useRecordContext, SimpleForm, TextInput, Edit, Create
} from 'react-admin';
import LanguageMIcon from '@mui/icons-material/Language';

export const LanguageIcon = LanguageMIcon;

const filmFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];

export const LanguageList = () => {
    return (
        <List filters={filmFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};
const LanguageTitle = () => {
    const record = useRecordContext();
    return <span>Language{record ? `: ${record.name}` : ''}</span>;
};
export const LanguageEdit = () => (
    <Edit title={<LanguageTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Edit>
);
export const LanguageCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
);

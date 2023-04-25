import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, Edit, useRecordContext, TextInput, SimpleForm, Create
} from 'react-admin';

import BlockIcon from '@mui/icons-material/Block';

export const FilmRuleIcon = BlockIcon;

const filmRuleFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];

export const FilmRuleList = () => {
    return (
        <List filters={filmRuleFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};
const FilmRuleTitle = () => {
    const record = useRecordContext();
    return <span>Film Rule{record ? `: ${record.name}` : ''}</span>;
};

export const FilmRuleEdit = () => (
    <Edit title={<FilmRuleTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Edit>
)

export const FilmRuleCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
)

import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, Edit, useRecordContext, TextInput, SimpleForm, Create
} from 'react-admin';

import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';

export const ClerkIcon = AdminPanelSettingsIcon;

const clerkFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];

export const ClerkList = () => {
    return (
        <List filters={clerkFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <TextField source="email"/>
                <TextField source="birthday"/>
                <TextField source="address"/>
                <TextField source="role"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};
const ClerkTitle = () => {
    const record = useRecordContext();
    return <span>Film Rule{record ? `: ${record.name}` : ''}</span>;
};

export const ClerkEdit = () => (
    <Edit title={<ClerkTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Edit>
)

export const ClerkCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
)

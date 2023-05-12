import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, Edit, useRecordContext, TextInput, SimpleForm, Create, DateTimeInput, DateInput
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
            <TextInput source="email" name="email"/>
            <TextInput source="birthday" name="birthday"/>
            <TextInput source="address" name="address"/>
        </SimpleForm>
    </Edit>
)

export const ClerkCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
            <TextInput source="email" name="email"/>
            <TextInput source="password" name="password"/>
            <DateInput source="birthday" name="birthday"/>
            <TextInput source="address" name="address"/>

        </SimpleForm>
    </Create>
)

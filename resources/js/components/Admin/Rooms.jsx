import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, Edit, useRecordContext, SimpleForm, TextInput
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const RoomIcon = BookIcon;
const roomFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];


export const RoomList = () => {
    return (
        <List filters={roomFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <TextField source="status" disabled/>
                <EditButton basePath=""/>
            </Datagrid>
        </List>
    )
};

const RoomTitle = () => {
    const record = useRecordContext();
    return <span>Film{record ? `: ${record.name}` : ''}</span>;
};
export const RoomEdit = () => (
    <Edit title={<RoomTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
            <TextInput disabled
                       source="status"
                       name="status"
                       format={value => value === 1 ? 'Full' : 'Unfull'}/>
        </SimpleForm>
    </Edit>
);


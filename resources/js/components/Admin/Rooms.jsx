import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, Edit, useRecordContext, SimpleForm, TextInput, Create
} from 'react-admin';

import MeetingRoomIcon from '@mui/icons-material/MeetingRoom';

export const RoomIcon = MeetingRoomIcon;

const roomFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>
];


export const RoomList = () => {
    return (
        <List filters={roomFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <TextField source="name"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};

const RoomTitle = () => {
    const record = useRecordContext();
    return <span>Room{record ? `: ${record.name}` : ''}</span>;
};
export const RoomEdit = () => (
    <Edit title={<RoomTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Edit>
);

export const RoomCreate = () => (
    <Create>
        <SimpleForm>
            <TextInput source="name" name="name"/>
        </SimpleForm>
    </Create>
)


import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton, ReferenceField, ChipField, TextInput
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';

export const ScheduleIcon = BookIcon;

const scheduleFilters = [
    <TextInput source="film_id" label="Search" alwaysOn name="search"/>
];
export const ScheduleList = () => {
    return (
        <List filters={scheduleFilters}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <ReferenceField source="film_id" reference="films">
                    <ChipField source="name"/>
                </ReferenceField>
                <ReferenceField source="room_id" reference="rooms">
                    <ChipField source="name"/>
                </ReferenceField>
                <TextField source="start"/>
                <TextField source="end"/>
                <TextField source="duration"/>
                <EditButton/>
            </Datagrid>
        </List>
    )
};

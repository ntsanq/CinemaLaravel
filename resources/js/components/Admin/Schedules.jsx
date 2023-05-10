import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton,
    ReferenceField,
    ChipField,
    TextInput,
    useRecordContext,
    Edit,
    SimpleForm,
    Create,
    ReferenceInput,
    SelectInput, TimeInput, NumberInput, DateInput, DateTimeInput
} from 'react-admin';
import ScheduleMIcon from '@mui/icons-material/Schedule';

export const ScheduleIcon = ScheduleMIcon;

const scheduleFilters = [
    <TextInput source="film_id" label="Search film names" alwaysOn name="search"/>,
    <ReferenceInput source="film_id" reference="films" name="film_id">
        <SelectInput optionText="name"/>
    </ReferenceInput>,
    <ReferenceInput source="room_id" reference="rooms" name="room_id">
        <SelectInput optionText="name"/>
    </ReferenceInput>,
    <DateInput name="start_date" source="date"/>
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
                <EditButton/>
            </Datagrid>
        </List>
    )
};

const ScheduleTitle = () => {
    const record = useRecordContext();
    return <span>Schedule{record ? `: ${record.film_name}` : ''}</span>;
};
export const ScheduleEdit = () => (
    <Edit title={<ScheduleTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <ReferenceInput source="film_id" reference="films" name="film_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <ReferenceInput source="room_id" reference="rooms" name="room_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <DateTimeInput name="start" source="start"/>
        </SimpleForm>
    </Edit>
);

export const ScheduleCreate = () => (
    <Create>
        <SimpleForm>
            <ReferenceInput source="film_id" reference="films" name="film_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <ReferenceInput source="room_id" reference="rooms" name="room_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <DateTimeInput name="start" source=""/>
        </SimpleForm>
    </Create>
)

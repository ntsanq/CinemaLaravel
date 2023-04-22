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
    SelectInput, TimeInput, NumberInput, DateInput
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
            <DateInput name="date" source="start"/>
            <TimeInput name="start_time" source="start" />
            <NumberInput name="duration" source="duration" placeholder="Duration (minutes)"/>
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
            <DateInput name="date" source="" />
            <TimeInput name="start_time" source="" />
            <NumberInput name="duration" source="" placeholder="Duration (minutes)"/>
        </SimpleForm>
    </Create>
)

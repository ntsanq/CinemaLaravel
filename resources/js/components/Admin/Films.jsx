import * as React from "react";
import {
    List,
    Datagrid,
    Edit,
    Create,
    SimpleForm,
    DateField,
    TextField,
    EditButton,
    TextInput,
    DateInput,
    useRecordContext,
    ImageField,
    Link,
    ArrayField,
    SingleFieldList,
    ChipField,
    SimpleList,
    EmailField,
    UrlField,
    ReferenceField, ReferenceArrayField
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
import {useMediaQuery} from "@mui/material";

export const FilmIcon = BookIcon;

export const FilmList = () => {

    const isSmall = useMediaQuery((theme) => theme.breakpoints.down("sm"));
    return (

        <List>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <ReferenceArrayField source="film_category_id" reference="filmCategories">
                    <SingleFieldList>
                        <ChipField source="name"/>
                    </SingleFieldList>
                </ReferenceArrayField>
                <ReferenceArrayField source="film_rule_id" reference="filmRules">
                    <SingleFieldList>
                        <ChipField source="name"/>
                    </SingleFieldList>
                </ReferenceArrayField>
                <TextField source="name"/>
                <ImageField source="path" label="Image"/>
                <UrlField source="trailer"/>
                <EditButton/>
            </Datagrid>
        </List>
    )

};

const FilmTitle = () => {
    const record = useRecordContext();
    return <span>Film {record ? `"${record.title}"` : ''}</span>;
};

export const FilmEdit = () => (
    <Edit title={<FilmTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id"/>
            <TextInput source="title"/>
            <TextInput source="teaser" options={{multiline: true}}/>
            <TextInput multiline source="body"/>
            <DateInput label="Publication date" source="published_at"/>
            <TextInput source="average_note"/>
            <TextInput disabled label="Nb views" source="views"/>
        </SimpleForm>
    </Edit>
);

export const FilmCreate = () => (
    <Create title="Create a Film">
        <SimpleForm>
            <TextInput source="title"/>
            <TextInput source="teaser" options={{multiline: true}}/>
            <TextInput multiline source="body"/>
            <TextInput label="Publication date" source="published_at"/>
            <TextInput source="average_note"/>
        </SimpleForm>
    </Create>
);

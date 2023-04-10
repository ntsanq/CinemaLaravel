import * as React from "react";
import {
    List,
    Datagrid,
    Edit,
    Create,
    SimpleForm,
    TextField,
    EditButton,
    TextInput,
    useRecordContext,
    ImageField,
    SingleFieldList,
    ChipField,
    ReferenceArrayField,
    ReferenceArrayInput,
    SelectArrayInput,
    RichTextField,
    ReferenceField,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
import {useMediaQuery} from "@mui/material";
import {RichTextInput} from "ra-input-rich-text";
import IframeField from "./CustomFields/IframeField";

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
                <IframeField source="trailer"/>
                <ReferenceField source="production_id" reference="productions">
                    <ChipField source="name"/>
                </ReferenceField>
                <ReferenceField source="language_id" reference="languages">
                    <ChipField source="name"/>
                </ReferenceField>
                <RichTextField source="description"/>
                <EditButton/>
            </Datagrid>
        </List>
    )

};

const FilmTitle = () => {
    const record = useRecordContext();
    return <span>Film{record ? `: ${record.name}` : ''}</span>;
};

export const FilmEdit = () => (
    <Edit title={<FilmTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
            <ReferenceArrayInput source="film_category_id" reference="filmCategories" name="film_category_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceArrayInput source="film_rule_id" reference="filmRules" name="film_rule_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceInput source="production_id" reference="productions" name="production_id">
                <SelectArrayInput source="name"/>
            </ReferenceInput>
            <ReferenceInput source="language_id" reference="languages" name="language_id">
                <SelectArrayInput source="name"/>
            </ReferenceInput>
            <TextInput label="Image" source="path" name="path" sx={{minWidth: "450px"}}/>
            <TextInput source="trailer" name="trailer" sx={{minWidth: "450px"}}/>
            <RichTextInput source="description" name="description"/>
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
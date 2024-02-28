import { TextField } from "@mui/material";

export const TextTypeComponent = ({
  question,
  handleTextChange,
  readOnlyFlag,
}) => {
  return (
    <>
      <TextField
        label="Respuesta"
        fullWidth
        margin="normal"
        variant="outlined"
        InputProps={{
          readOnly: readOnlyFlag,
        }}
        InputLabelProps={{
          shrink: true,
        }}
        onChange={(e) => handleTextChange(question.id, e.target.value)}
      />
    </>
  );
};
